import {Component, OnInit} from '@angular/core';
import {ITypeCamp, TypeCamp} from '../shared/model/type-de-camp.model';
import {TypeCampService} from '../shared/service/type-de-camp.service';
import {CampService} from '../shared/service/camp.service';
import {FormArray, FormBuilder, FormGroup} from '@angular/forms';
import {filterOkMapBody} from '../shared/util/http.utils';
import {Observable} from 'rxjs';
import {ICamp, ICampCreationDTO} from '../shared/model/camp.model';
import {Router} from '@angular/router';

@Component({
  selector: 'ddc-camp-creation',
  templateUrl: './camp-creation.page.component.html',
  styleUrls: ['./camp-creation.page.component.scss']
})

export class CampCreationPageComponent implements OnInit {
  typeCamps: TypeCamp[] = [];

  formGroup = this.fb.group({
    typeCamp: [],
    libelle: [],
  });

  modulesFormGroups: FormGroup[] = [];

  typeCamps$: Observable<ITypeCamp[]>;
  modules: [];
  typeCamp: any;

  constructor(
    private typeCampService: TypeCampService,
    private fb: FormBuilder,
    private campService: CampService,
    private router: Router
  ) {}

  ngOnInit() {
    this.typeCamps$ = this.typeCampService.find().pipe(
      filterOkMapBody
    );

    this.formGroup.get('typeCamp').valueChanges.subscribe((typeCamp: ITypeCamp) => {
      this.modules = typeCamp.modules;
      const formArray = this.fb.array(typeCamp.modules.map(module => this.fb.group({isChecked: false, module})));
      this.modulesFormGroups = typeCamp.modules.map(module => this.fb.group({isChecked: false, module}));
    });
  }

  enregistrer() {
    const formGroupRawValue = this.formGroup.getRawValue();
    const campCreationDTO: ICampCreationDTO = {
      codeTypeCamp: formGroupRawValue.typeCamp.code,
      libelle: formGroupRawValue.libelle,
      codemodules: this.modulesFormGroups
        .map(control => control.getRawValue() as {isChecked: boolean, module: any})
        .filter(controlRawValue => controlRawValue.isChecked)
        .map(controlRawValue => controlRawValue.module.module.code)
    };
    this.campService.create(campCreationDTO)
      .pipe(filterOkMapBody)
      .subscribe((camp: ICamp) => {
        this.router.navigate(['/camp', camp.id]);
      });
  }
}
