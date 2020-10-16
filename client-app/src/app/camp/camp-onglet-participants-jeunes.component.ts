import { Component, OnInit, ViewChild } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormGroup } from '@angular/forms';
import { CampService } from '../shared/service/camp.service';
import { AbstractCampOngletComponent } from './abstract-camp-onglet.component';
import { SelectionModel } from '@angular/cdk/collections';
import { IAdherent } from '../shared/model/adherent.model';
import { AdherentService } from '../shared/service/adherent.service';
import { filterOkMapBody } from '../shared/util/http.utils';
import { MatTableDataSource } from '@angular/material/table';
import { ICamp } from '../shared/model/camp.model';
import { MatSort } from '@angular/material/sort';
import { CampAdherentParticipant } from '../shared/model/camp-adherent-participant.model';

@Component({
  selector: 'ddc-camp-onglet-participants-jeunes',
  templateUrl: './camp-onglet-participants-jeunes.component.html',
  styleUrls: ['./camp-onglet-participants-jeunes.component.scss']
})
export class CampOngletParticipantsJeunesComponent extends AbstractCampOngletComponent implements OnInit {
  private static readonly MODULE_NAME = 'PARTICIPANT';

  adherentsDisponiblesTableSelectionModel = new SelectionModel<IAdherent>(true, []);
  adherentsDisponiblesTableDataSource = new MatTableDataSource<IAdherent>([]);
  adherentsDisponiblesTableDisplayedColumns = ['selection', 'numero', 'prenom', 'nom'];

  @ViewChild(MatSort, {static: true}) sort: MatSort;

  allAdherentsDisponibles: IAdherent[] = [];

  campParticipantsTableDataSource = new MatTableDataSource<AbstractControl>([]);
  campParticipantsTableDisplayedColumns = ['numero', 'prenom', 'nom'];

  campParticipantSelectionneFormGroup: FormGroup;

  constructor(
    protected campService: CampService,
    private fb: FormBuilder,
    adherentService: AdherentService
  ) {
    super(campService, CampOngletParticipantsJeunesComponent.MODULE_NAME, fb.group({
      participants: fb.array([])
    }));

    // Récupération de l'ensemble des adhérents disponibles pour l'utilisateur connecté actuellement
    adherentService.find()
      .pipe(filterOkMapBody)
      .subscribe((adherents: IAdherent[]) => {
        // On supprime les adhérents déjà présents dans la liste des adhérents sélectionnés
        this.allAdherentsDisponibles = adherents;
        this.initAdherentsDisponiblesTableData();
      });
  }

  ngOnInit(): void {
    this.adherentsDisponiblesTableDataSource.sort = this.sort;
  }

  private initAdherentsDisponiblesTableData() {
    const participantAdherentNumeros = new Set<number>(this.getParticipantsFormArray().getRawValue().map(participant => participant.adherent.numero));
    this.adherentsDisponiblesTableDataSource.data = this.allAdherentsDisponibles.filter(adherent => !participantAdherentNumeros.has(adherent.numero));
  }

  updateFormPatchValue(campFormPatchValue: ICamp) {
    // Lors d'une récupération de l'état du formulaire (du cache par exemple)
    super.updateFormPatchValue(campFormPatchValue); // on patch le formulaire
    // On patch à la main le FormArray en suivant https://dev.to/crazedvic/using-patchvalue-on-formarrays-in-angular-7-2c8c
    const participantsFormArray = this.getParticipantsFormArray();
    participantsFormArray.clear();
    campFormPatchValue.participants.forEach(participant => {
      // Création des champs qui n'existe pas (pour être sûr de créer le formControl associé
      participant.chefEquipe = participant.chefEquipe || false;
      participant.coordonneesParents = participant.coordonneesParents || null;

      participantsFormArray.push(this.fb.group(participant));
    });

    // Puis on va supprimer de la liste des adhérents disponibles les adhérents présents dans le camp
    this.initAdherentsDisponiblesTableData();
    // On connecte le modèle de la table de droite aux données du form array
    this.initCampParticipantsTableData(participantsFormArray);
  }

  private initCampParticipantsTableData(participantsFormArray) {
    this.campParticipantsTableDataSource.data = participantsFormArray && participantsFormArray.controls || [];
  }

  private getParticipantsFormArray(): FormArray {
    return this.campForm.get('participants') as FormArray;
  }

  isTousAdherentsDisponiblesSelectionnes() {
    const numSelected = this.adherentsDisponiblesTableSelectionModel.selected.length;
    const numRows = this.adherentsDisponiblesTableDataSource.data.length;
    return numSelected == numRows;
  }

  selectionnerTousAdherentsDisponibles() {
    this.isTousAdherentsDisponiblesSelectionnes() ?
      this.adherentsDisponiblesTableSelectionModel.clear() :
      this.adherentsDisponiblesTableDataSource.data.forEach(row => this.adherentsDisponiblesTableSelectionModel.select(row));
  }

  ajouterAdherentsDisponiblesSelectionnes() {
    const participantsFormArray = this.getParticipantsFormArray();

    // On ajoute les adhérents sélectionnés
    this.adherentsDisponiblesTableSelectionModel.selected.map(adherent => {
      const campAdherentParticipant = new CampAdherentParticipant();
      campAdherentParticipant.adherent = adherent;
      participantsFormArray.push(this.fb.group(campAdherentParticipant));
    });

    // On ré-initialise la liste des adhérents disponibles
    this.adherentsDisponiblesTableSelectionModel.clear();
    this.initAdherentsDisponiblesTableData();
    this.initCampParticipantsTableData(participantsFormArray);
  }

  selectionnerCampParticipant(row: FormGroup) {
    this.campParticipantSelectionneFormGroup = row;
  }

  supprimerCampParticipantSelectionne() {
    const participantsFormArray = this.getParticipantsFormArray();
    const controlIndex = participantsFormArray.controls.findIndex(control => control === this.campParticipantSelectionneFormGroup);
    if (controlIndex !== -1) {
      participantsFormArray.removeAt(controlIndex);

      this.initAdherentsDisponiblesTableData();
      this.initCampParticipantsTableData(participantsFormArray);

      this.campParticipantSelectionneFormGroup = null;
    }
  }
}
