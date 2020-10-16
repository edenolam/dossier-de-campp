export interface ITypeCamp {
  id?: number;
  code?: string;
  libelle?: string;
  modules?: [];
}

export class TypeCamp implements ITypeCamp {
  constructor(
    public id?: number,
    public code?: string,
    public libelle?: string,
    public modules?: [],
  ) {}
}
