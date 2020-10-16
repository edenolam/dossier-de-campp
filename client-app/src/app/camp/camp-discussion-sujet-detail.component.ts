import {Component, Input, OnInit} from '@angular/core';
import {ICampDiscussionSujet} from '../shared/model/camp-discussion-sujet.model';

@Component({
  selector: 'ddc-camp-discussion-sujet-detail',
  templateUrl: './camp-discussion-sujet-detail.component.html',
  styleUrls: ['./camp-discussion-sujet-detail.component.scss']
})
export class CampDiscussionSujetDetailComponent implements OnInit {

  @Input() sujet: ICampDiscussionSujet;

  constructor() { }

  ngOnInit() {
  }

}
