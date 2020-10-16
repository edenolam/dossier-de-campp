import { Observable } from 'rxjs';
import { HttpResponse } from '@angular/common/http';
import { filter, map } from 'rxjs/operators';

export function filterOkMapBody<T>(observable: Observable<HttpResponse<T>>): Observable<T> {
  return observable.pipe(
    filter((response: HttpResponse<T>) => response.ok),
    map((response: HttpResponse<T>) => response.body)
  );
}
