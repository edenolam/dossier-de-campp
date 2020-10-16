import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { environment } from '../../../environments/environment';
import { Observable } from 'rxjs';
import { IAdherent } from '../model/adherent.model';

@Injectable({
  providedIn: 'root'
})
export class AdherentService {
  public readonly resourceUrl = environment.apiServerUrl + 'adherents';

  constructor(protected http: HttpClient) {
  }

  find(): Observable<HttpResponse<IAdherent[]>> {
    return this.http
      .get<IAdherent[]>(this.resourceUrl, { observe: 'response' });
  }

  findByNumero(numero: number): Observable<HttpResponse<IAdherent>> {
    return this.http
      .get<IAdherent>(`${this.resourceUrl}?numero=${numero}`, { observe: 'response' });
  }

}
