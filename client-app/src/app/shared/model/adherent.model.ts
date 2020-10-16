export interface IAdherent {
  numero?: number;
  prenom?: string;
  nom?: string;
}

export class Adherent implements IAdherent {
  constructor(
    public numero?: number,
    public prenom?: string,
    public nom?: string,
  ) {}
}
