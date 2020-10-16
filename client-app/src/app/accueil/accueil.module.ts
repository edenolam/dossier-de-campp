import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {AccueilRoutingModule} from './accueil-routing.module';
import {AccueilPageComponent} from './accueil.page.component';
import {MatButtonModule, MatIconModule, MatTableModule, MatCardModule, MatGridListModule} from '@angular/material';
import {HttpClientModule} from '@angular/common/http';


@NgModule({

  declarations: [AccueilPageComponent],

  imports: [
    CommonModule,
    AccueilRoutingModule,
    MatGridListModule,
    MatCardModule,
    MatTableModule,
    MatIconModule,
    MatButtonModule
  ]
})
export class AccueilModule {
}
