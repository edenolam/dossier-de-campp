import { IAdherent } from './adherent.model';
import { ICampAdherent } from './camp-adherent.model';
import { Moment } from 'moment';

export interface ICampAdherentParticipant extends ICampAdherent {
  chefEquipe?: boolean;
  coordonneesParents?: string;
}

export class CampAdherentParticipant implements ICampAdherentParticipant {
  constructor(
    public id?: number,
    public adherent?: IAdherent,
    public dateDebutPresence?: Moment,
    public dateFinPresence?: Moment,
    public mossAccompagnementSpecifique?: boolean,

    public chefEquipe?: boolean,
    public coordonneesParents?: string,
  ) {
  }
}
