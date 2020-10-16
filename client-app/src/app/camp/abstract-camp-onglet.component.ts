import { CampService } from '../shared/service/camp.service';
import { FormGroup } from '@angular/forms';
import { CampContext, ModuleCache } from './camp.page.component';
import { ICamp } from '../shared/model/camp.model';
import { Input } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpResponse } from '@angular/common/http';
import { filter, skip } from 'rxjs/operators';
import { CampHistoriqueModificationService } from '../shared/service/camp-historique-modification.service';

export abstract class AbstractCampOngletComponent {
  public static readonly CAMP_HISTO_MODULE_DERNIERE_MODIFICATION_HEADER_NAME = 'X-Ddc-Camp_histo_module_derniere_modification';
  public static readonly DDC_LOCAL_STORAGE_PREFIX = 'DDC-';

  protected _campContext: CampContext = {};

  protected moduleCache: ModuleCache;

  isSaving = false;

  protected constructor(
    protected campService: CampService,
    protected moduleCode: string,
    protected campForm: FormGroup
  ) {
    campForm.valueChanges
      .pipe(skip(1)) // On ignore le premier valueChange qui est l'initialisation de ses valeurs
      .subscribe(campFormRawValue => localStorage.setItem(this.getModuleCacheLocalStorageCacheKey(), JSON.stringify({
        campHistoModuleDerniereModification: this.moduleCache && this.moduleCache.campHistoModuleDerniereModification,
        campFormRawValue: campFormRawValue
      } as ModuleCache)));
  }

  @Input()
  set campContext(campContext: CampContext) {
    this._campContext = campContext;
    const moduleCache: ModuleCache = campContext.modulesCache[this.moduleCode];
    if (!moduleCache && campContext.camp) {
      // Le module n'est pas encore chargé, on le charge
      this.campService.findOneByIdAndModuleCode(campContext.camp.id, this.moduleCode)
        .pipe(filter((response: HttpResponse<ICamp>) => response.ok))
        .subscribe((response: HttpResponse<ICamp>) => this.updateForm(campContext.modulesCache[this.moduleCode] = {
          camp: response.body,
          moduleCode: this.moduleCode,
          campHistoModuleDerniereModification:
            CampHistoriqueModificationService.convertDateFromServer(
              JSON.parse(
                response.headers.get(AbstractCampOngletComponent.CAMP_HISTO_MODULE_DERNIERE_MODIFICATION_HEADER_NAME) || 'null'
              )
            )
        }));
    } else {
      // Module chargé, on met à jour le form directement avec le cache
      this.updateForm(moduleCache);
    }
  }

  updateForm(moduleCache: ModuleCache) {
    if (moduleCache) {
      let campFormPatchValue = moduleCache.camp;

      // On compare avec le localStorage
      const moduleCacheLocalStorageCacheKey = this.getModuleCacheLocalStorageCacheKey();
      const localStorageModuleCache: ModuleCache = JSON.parse(localStorage.getItem(moduleCacheLocalStorageCacheKey) || 'null');
      if (localStorageModuleCache) {
        localStorageModuleCache.campHistoModuleDerniereModification = CampHistoriqueModificationService.convertDateFromServer(localStorageModuleCache.campHistoModuleDerniereModification); // On convertit les dates en objets Moment
        // un module cache existe en local storage, nous allons comparer les versions
        if ((localStorageModuleCache.campHistoModuleDerniereModification == null && moduleCache.campHistoModuleDerniereModification != null) // local storage a un histo null, mais pas le remote
            || (localStorageModuleCache.campHistoModuleDerniereModification != null && moduleCache.campHistoModuleDerniereModification != null
                 && localStorageModuleCache.campHistoModuleDerniereModification.dateHeureModification.isBefore(moduleCache.campHistoModuleDerniereModification.dateHeureModification)
               )
        ) {
          // FIXME la version du local storage est antérieur à celle du serveur, on doit donc la supprimer et avertir l'utilisateur
          console.error(`FIXME : La version du local storage est antérieur à celle du serveur, on doit donc la supprimer et avertir l'utilisateur : ${moduleCacheLocalStorageCacheKey}`);
          localStorage.removeItem(moduleCacheLocalStorageCacheKey);
        } else {
          // La version du local storage est toujours d'actualité, on la charge
          console.log(`Version du local storage chargée : ${moduleCacheLocalStorageCacheKey} / ${localStorageModuleCache.campHistoModuleDerniereModification && localStorageModuleCache.campHistoModuleDerniereModification.dateHeureModification}`); // FIXME le header renvoie un dateHeureModification alors que l'objet camp comporte un dateHeureModification...
          campFormPatchValue = {
            ...campFormPatchValue,
            ...CampService.convertDateFromServer(localStorageModuleCache.campFormRawValue) // TODO nécessaire pour charger les dates au format Moment depuis le local storage mais ne fonctionnera plus si le form ne map pas directement un camp...
          }
        }
      }
      this.moduleCache = moduleCache;
      this.updateFormPatchValue(campFormPatchValue);
    }
  }

  updateFormPatchValue(campFormPatchValue: ICamp) {
    this.campForm.patchValue(campFormPatchValue);
  }

  private getModuleCacheLocalStorageCacheKey() {
    return `${AbstractCampOngletComponent.DDC_LOCAL_STORAGE_PREFIX}CampModule-${this._campContext.camp.id}-${this.moduleCode}`;
  }

  private createFromForm(): ICamp {
    // Suppression des champs d'histo pour éviter ce genre d'erreur : "You must define a type for App\Entity\CampHistoriqueModification::$modificationJson"
    const camp = {
      ...this.moduleCache.camp
    };
    delete camp.histoCreation;
    delete camp.histoDerniereModification;

    return {
      ...camp,
      ...this.campForm.getRawValue()
    };
  }

  save() {
    this.isSaving = true;
    const camp = this.createFromForm();
    if (camp.id !== undefined) {
      this.subscribeToSaveResponse(this.campService.updateByCampAndModuleCode(camp, this.moduleCode));
    } else {
      this.subscribeToSaveResponse(this.campService.create(camp));
    }
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<ICamp>>) {
    result.subscribe(() => this.onSaveSuccess(), () => this.onSaveError());
  }

  protected onSaveSuccess() {
    this.isSaving = false;
  }

  protected onSaveError() {
    this.isSaving = false;
  }
}
