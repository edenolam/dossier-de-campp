import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { ICampDiscussionSujet } from '../model/camp-discussion-sujet.model';
import { environment } from '../../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CampDiscussionSujetService {
  campDiscussionSujet: ICampDiscussionSujet;

  constructor(protected http: HttpClient) {
  }
  public resourceUrl = environment.apiServerUrl + 'camp-discussion-sujets';

  find(idCamp: number, codeModule?: string, statut?: string): Observable<HttpResponse<ICampDiscussionSujet[]>> {
    const url = `${this.resourceUrl}?id_camp=${idCamp}&code_module=${codeModule}&statut=${statut}`;
    return this.http.get<ICampDiscussionSujet[]>(url, {observe: 'response'});
  }

  create(campDiscussionSujet: ICampDiscussionSujet): Observable<HttpResponse<ICampDiscussionSujet>> {
    return this.http.post<ICampDiscussionSujet>(this.resourceUrl, campDiscussionSujet, { observe: 'response' });
  }


}
