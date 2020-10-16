import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { ICampHistoriqueModification } from '../model/camp-historique-modification.model';
import { convertDateFromServer } from '../util/moment.utils';

@Injectable({
  providedIn: 'root'
})
export class CampHistoriqueModificationService {
  public resourceUrl = environment.apiServerUrl + 'camp-historique-modifications';

  constructor(protected http: HttpClient) {
  }


  static convertDateFromServer(campHistoriqueModification: ICampHistoriqueModification): ICampHistoriqueModification {
    if (campHistoriqueModification) {
      convertDateFromServer(campHistoriqueModification, ['dateHeureModification']);
    }
    return campHistoriqueModification;
  }
}
