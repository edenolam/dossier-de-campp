import {Injectable} from '@angular/core';
import {HttpClient, HttpResponse} from '@angular/common/http';
import {environment} from '../../../environments/environment';
import {Observable} from 'rxjs';
import {ITypeCamp} from '../model/type-de-camp.model';

@Injectable({
  providedIn: 'root'
})
export class TypeCampService {

  constructor(protected http: HttpClient) {
  }

  public typeCampsUrl = environment.apiServerUrl + 'type-camps';


  find(): Observable<HttpResponse<ITypeCamp[]>> {
    return this.http.get<ITypeCamp[]>(this.typeCampsUrl, {observe: 'response'});
  }

}
