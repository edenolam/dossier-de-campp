import {Component, Input, OnInit} from '@angular/core';
import {CampDiscussionSujetService} from '../shared/service/camp-discussion-sujet.service';
import {filterOkMapBody} from '../shared/util/http.utils';
import {Observable} from 'rxjs';
import {ICampDiscussionSujet} from '../shared/model/camp-discussion-sujet.model';
import {Router} from '@angular/router';
import {CampContext} from './camp.page.component';

@Component({
  selector: 'ddc-camp-discussion-sujet',
  templateUrl: './camp-discussion-sujet.component.html',
  styleUrls: ['./camp-discussion-sujet.component.scss']
})
export class CampDiscussionSujetComponent implements OnInit {

  @Input() campContext: CampContext;
  @Input() codeModule: string;

  campsDiscussionSujet$: Observable<ICampDiscussionSujet[]>;

  constructor(
    private campDiscussionSujetService: CampDiscussionSujetService,
    private router: Router
  ) {
  }

  ngOnInit() {
    this.campsDiscussionSujet$ = this.campDiscussionSujetService
      .find(1 /* this.campContext.camp.id*/, this.codeModule, '1')
      .pipe(
        filterOkMapBody
      );
  }

  ajouterRemarque() {
    console.log('ajouter une remarque');
  }
}
