import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AccueilPageComponent } from './accueil.page.component';

const routes: Routes = [{ path: '', component: AccueilPageComponent }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AccueilRoutingModule { }
