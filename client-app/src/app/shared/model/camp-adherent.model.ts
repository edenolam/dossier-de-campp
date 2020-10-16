import { IAdherent } from './adherent.model';
import { Moment } from 'moment';

export interface ICampAdherent {
  id?: number;
  adherent?: IAdherent;
  dateDebutPresence?: Moment;
  dateFinPresence?: Moment;
  mossAccompagnementSpecifique?: boolean;
}

export class CampAdherent implements ICampAdherent {
  constructor(
    public id?: number,
    public adherent?: IAdherent,
    public dateDebutPresence?: Moment,
    public dateFinPresence?: Moment,
    public mossAccompagnementSpecifique?: boolean,
  ) {}
}
