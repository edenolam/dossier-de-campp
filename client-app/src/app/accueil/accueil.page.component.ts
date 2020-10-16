import {Component, OnInit} from '@angular/core';
import {CampService} from '../shared/service/camp.service';
import {filterOkMapBody} from '../shared/util/http.utils';
import {Observable} from 'rxjs';
import {ICamp} from '../shared/model/camp.model';
import {Router} from '@angular/router';

@Component({
  selector: 'ddc-accueil-page',
  templateUrl: './accueil.page.component.html',
  styleUrls: ['./accueil.page.component.scss']
})
export class AccueilPageComponent implements OnInit {

  camps$: Observable<ICamp[]>;

  mesCampsDisplayedColumns = [
    'creeLe',
    'creePar',
    'libelle',
    'typeDeCamp',
  ];

  constructor(private campService: CampService, private router: Router) { }

  ngOnInit() {
    this.camps$ = this.campService.find().pipe(
      filterOkMapBody
    );
  }

  onNewCamp() {
    this.router.navigate(['/camp']);
  }

}
