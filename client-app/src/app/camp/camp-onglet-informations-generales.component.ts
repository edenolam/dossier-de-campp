import { Component } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { CampService } from '../shared/service/camp.service';
import { AbstractCampOngletComponent } from './abstract-camp-onglet.component';

@Component({
  selector: 'ddc-camp-onglet-informations-generales',
  templateUrl: './camp-onglet-informations-generales.component.html',
  styleUrls: ['./camp-onglet-informations-generales.component.scss']
})
export class CampOngletInformationsGeneralesComponent extends AbstractCampOngletComponent {
  private static readonly MODULE_NAME = 'INFO_GENERALE';

  constructor(
    protected campService: CampService,
    private fb: FormBuilder
  ) {
    super(campService, CampOngletInformationsGeneralesComponent.MODULE_NAME, fb.group({
      libelle: [],
      dateDebut: [],
      dateFin: []
    }));
  }

}
