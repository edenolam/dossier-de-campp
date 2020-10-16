import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CampRoutingModule } from './camp-routing.module';
import { CampPageComponent } from './camp.page.component';
import { MatSliderModule } from '@angular/material/slider';
import { MatSlideToggleModule } from '@angular/material/slide-toggle';
import { MatCardModule } from '@angular/material/card';
import { MatTabsModule } from '@angular/material/tabs';
import { MatListModule } from '@angular/material/list';
import { MatGridListModule } from '@angular/material/grid-list';
import { MatIconModule } from '@angular/material/icon';
import { MatButtonModule } from '@angular/material/button';
import { DragDropModule } from '@angular/cdk/drag-drop';
import { ReactiveFormsModule } from '@angular/forms';
import { MatTableModule } from '@angular/material/table';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatOptionModule } from '@angular/material/core';
import { MatSelectModule } from '@angular/material/select';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatMomentDateModule } from '@angular/material-moment-adapter';
import { CampOngletInformationsGeneralesComponent } from './camp-onglet-informations-generales.component';
import { CampCreationPageComponent } from './camp-creation.page.component';
import { MatRadioModule } from '@angular/material/radio';
import { MatCheckboxModule } from '@angular/material/checkbox';
import { CampDiscussionSujetComponent } from './camp-discussion-sujet.component';
import { CampOngletParticipantsJeunesComponent } from './camp-onglet-participants-jeunes.component';
import { MatSortModule } from '@angular/material/sort';
import {MatChipsModule} from "@angular/material/chips";
import { CampDiscussionSujetDetailComponent } from './camp-discussion-sujet-detail.component';
import { CampOngletRemarquesComponent } from './camp-onglet-remarques.component';


@NgModule({
  declarations: [
    CampPageComponent,
    CampOngletInformationsGeneralesComponent,
    CampCreationPageComponent,
    CampDiscussionSujetComponent,
    CampOngletParticipantsJeunesComponent,
    CampDiscussionSujetDetailComponent,
    CampOngletRemarquesComponent
  ],
  imports: [
    CommonModule,
    CampRoutingModule,
    MatSliderModule,
    MatSlideToggleModule,
    MatCardModule,
    MatTabsModule,
    MatListModule,
    MatGridListModule,
    MatIconModule,
    MatButtonModule,
    DragDropModule,
    ReactiveFormsModule,
    MatTableModule,
    MatFormFieldModule,
    MatInputModule,
    MatOptionModule,
    MatSelectModule,
    MatDatepickerModule,
    MatMomentDateModule,
    MatRadioModule,
    MatCheckboxModule,
    MatSortModule,
    MatChipsModule
  ]
})
export class CampModule {
}
