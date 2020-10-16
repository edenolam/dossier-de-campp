import {Component, Input, OnInit} from '@angular/core';
import {Observable} from "rxjs";
import {ICampDiscussionSujet} from "../shared/model/camp-discussion-sujet.model";
import {CampDiscussionSujetService} from "../shared/service/camp-discussion-sujet.service";
import {Router} from "@angular/router";
import {filterOkMapBody} from '../shared/util/http.utils';
import {CampContext} from "./camp.page.component";

@Component({
  selector: 'ddc-camp-onglet-remarques',
  templateUrl: './camp-onglet-remarques.component.html',
  styleUrls: ['./camp-onglet-remarques.component.scss']
})
export class CampOngletRemarquesComponent implements OnInit {

  @Input() campContext: CampContext;
  statut = '0';
  campsDiscussionSujet$: Observable<ICampDiscussionSujet[]>;

  constructor(
    private campDiscussionSujetService: CampDiscussionSujetService,
    private router: Router
  ) {
  }

  ngOnInit() {
    this.campsDiscussionSujet$ = this.campDiscussionSujetService
      .find(1 /*this.campContext.camp.id */ , '', this.statut === '0' ? '' : this.statut )
      .pipe(
        filterOkMapBody
      );
  }


  doOnStatutChanged() {
    this.campsDiscussionSujet$ = this.campDiscussionSujetService
      .find(1 /*this.campContext.camp.id */ , '', this.statut === '0' ? '' : this.statut)
      .pipe(
        filterOkMapBody
      );
  }
}
