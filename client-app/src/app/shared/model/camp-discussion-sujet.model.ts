import { Moment } from 'moment';

export interface ICampDiscussionSujet {
  id?: number;
codeModule?: string;
dateHeureCreation?: Moment;
sujet?: string;
statut?: boolean;
}

export class CampDiscussionSujet implements ICampDiscussionSujet {
  constructor(
    public id?: number,
    public codeModule?: string,
    public dateHeureCreation?: Moment,
    public sujet?: string,
    public statut?: boolean,
  ) {}
}
