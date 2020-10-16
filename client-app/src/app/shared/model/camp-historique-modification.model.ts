import { Moment } from 'moment';
import { IAdherent } from './adherent.model';

export interface ICampHistoriqueModification {
  id?: number;
  dateHeureModification?: Moment;
  adherent?: IAdherent;
}

export class CampHistoriqueModification implements ICampHistoriqueModification{
  constructor(
    public id?: number,
    public dateHeureModification?: Moment,
    public adherent?: IAdherent,
  ) {}
}
