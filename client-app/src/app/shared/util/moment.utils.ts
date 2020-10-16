import * as moment from 'moment';
import { Moment } from 'moment';

export function convertDateFromServer<T extends Object>(object: T, dateFields: string[]): T {
  if (object) {
    dateFields.forEach(dateField => {
      object[dateField] = object[dateField] != null ? moment.utc(object[dateField]).local() : null;
    });
  }
  return object;
}

export function convertDateFromClient<T extends Object>(object: T, dateFields: string[]): T {
  if (object) {
    const objectDateFields = {};
    dateFields.forEach(dateField => {
      let dateFieldValue: Moment = object[dateField];
      objectDateFields[dateField] = dateFieldValue != null && dateFieldValue.isValid() ? dateFieldValue.toISOString() : null;
    });
    return Object.assign({}, object, objectDateFields);
  } else {
    return object;
  }
}
