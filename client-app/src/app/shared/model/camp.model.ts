import { Moment } from 'moment';
import { ICampHistoriqueModification } from './camp-historique-modification.model';
import { ICamp817 } from './camp817.model';
import { ICampAdherentParticipant } from './camp-adherent-participant.model';

export interface ICamp {
  id?: number;
  libelle?: string;
  dateDebut?: Moment;
  dateFin?: Moment;
  histoCreation?: ICampHistoriqueModification;
  histoDerniereModification?: ICampHistoriqueModification;
  structureOrganisatrice?: string;
  camp817?: ICamp817;
  participants?: ICampAdherentParticipant[];
}

export class Camp implements ICamp {
  constructor(
    public id?: number,
    public libelle?: string,
    public dateDebut?: Moment,
    public dateFin?: Moment,
    public histoCreation?: ICampHistoriqueModification,
    public histoDerniereModification?: ICampHistoriqueModification,
    public structureOrganisatrice?: string,
    public participants?: ICampAdherentParticipant[],
  ) {}
}

export interface ICampCreationDTO {
  codeTypeCamp?: string;
  libelle?: string;
  dateDebut?: Moment;
  dateFin?: Moment;
  codemodules?: string[];
}

export class CampCreationDTO implements ICampCreationDTO{
  constructor(
    public codeTypeCamp?: string,
    public libelle?: string,
    public dateDebut?: Moment,
    public dateFin?: Moment,
    public codemodules?: string[],
  ) {}
}
