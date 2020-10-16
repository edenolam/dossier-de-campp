import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { environment } from '../../../environments/environment';
import {ICamp, ICampCreationDTO} from '../model/camp.model';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { CampHistoriqueModificationService } from './camp-historique-modification.service';
import { convertDateFromServer, convertDateFromClient } from '../util/moment.utils';

@Injectable({
  providedIn: 'root'
})
export class CampService {

  constructor(protected http: HttpClient) {
  }

  private static readonly DATE_FIELDS = ['dateDebut', 'dateFin'];
  public resourceUrl = environment.apiServerUrl + 'camps';

  static convertDateFromServer(camp: ICamp): ICamp {
    if (camp) {
      convertDateFromServer(camp, CampService.DATE_FIELDS);
      if (camp.histoCreation) {
        CampHistoriqueModificationService.convertDateFromServer(camp.histoCreation);
      }
    }
    return camp;
  }

  private static convertDateFromClient(camp: ICamp): ICamp {
    return convertDateFromClient(camp, CampService.DATE_FIELDS);
  }

  private static convertDateFromClientForCampCreationDTO(campCreationDTO: ICampCreationDTO): ICampCreationDTO {
    return convertDateFromClient(campCreationDTO, CampService.DATE_FIELDS);
  }

  find(): Observable<HttpResponse<ICamp[]>> {
    return this.http
      .get<ICamp[]>(this.resourceUrl, { observe: 'response' })
      .pipe(map(res => this.convertDateArrayFromServer(res)));
  }

  findOneByIdAndModuleCode(id: number, moduleCode?: string): Observable<HttpResponse<ICamp>> {
    const moduleCodeQuery = moduleCode ? `?module=${moduleCode}` : '';
    return this.http
      .get<ICamp>(`${this.resourceUrl}/${id}${moduleCodeQuery}`, { observe: 'response' })
      .pipe(map(res => this.convertDateFromServer(res)));
  }

  updateByCampAndModuleCode(camp: ICamp, moduleCode?: string): Observable<HttpResponse<ICamp>> {
    const copy = CampService.convertDateFromClient(camp);
    const moduleCodePath = moduleCode ? `/modules/${moduleCode}` : '';
    return this.http
      .put<ICamp>(`${this.resourceUrl}${moduleCodePath}`, copy, { observe: 'response' })
      .pipe(map(res => this.convertDateFromServer(res)));
  }

  create(campCreationDTO: ICampCreationDTO): Observable<HttpResponse<ICamp>> {
    const copy = CampService.convertDateFromClientForCampCreationDTO(campCreationDTO);
    return this.http
      .post<ICamp>(this.resourceUrl, copy, { observe: 'response' })
      .pipe(map(res => this.convertDateFromServer(res)));
  }

  /**
   * Convertit les dates renvoyées par le serveur en date cliente (pour un camp)
   * @param res
   */
  protected convertDateFromServer(res: HttpResponse<ICamp>): HttpResponse<ICamp> {
    if (res.body) {
      CampService.convertDateFromServer(res.body);
    }
    return res;
  }

  /**
   * Convertit les dates renvoyées par le serveur en date cliente (pour plusieurs camp)
   * @param res
   */
  protected convertDateArrayFromServer(res: HttpResponse<ICamp[]>): HttpResponse<ICamp[]> {
    if (res.body) {
      res.body.forEach((camp: ICamp) => {
        CampService.convertDateFromServer(camp);
      });
    }
    return res;
  }
}
