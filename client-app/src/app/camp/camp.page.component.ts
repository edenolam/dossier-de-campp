import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { CampService } from '../shared/service/camp.service';
import { filterOkMapBody } from '../shared/util/http.utils';
import { ICamp } from '../shared/model/camp.model';
import { ICampHistoriqueModification } from '../shared/model/camp-historique-modification.model';

export type ModuleCache = {camp?: ICamp, moduleCode?: string, campHistoModuleDerniereModification?: ICampHistoriqueModification, campFormRawValue?: any};
export type CampContext = {camp?: ICamp, modulesCache?: {[key: string]: ModuleCache}};

@Component({
  selector: 'ddc-camp-page',
  templateUrl: './camp.page.component.html',
  styleUrls: ['./camp.page.component.scss']
})
export class CampPageComponent implements OnInit {

  campContext: CampContext = {modulesCache: {}};

  constructor(
    private activatedRoute: ActivatedRoute,
    private campService: CampService
  ) {
  }

  ngOnInit() {
    this.activatedRoute.paramMap.subscribe(paramMap => {
      const idCamp = paramMap.get('idCamp');
      if (idCamp) {
        this.campService.findOneByIdAndModuleCode(parseInt(idCamp, 10))
          .pipe(
            filterOkMapBody
          )
          .subscribe((camp: ICamp) => this.campContext = {camp, modulesCache: {}});
      }
    });
  }


}
