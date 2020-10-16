import 'hammerjs';
import { enableProdMode } from '@angular/core';
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';

import { AppModule } from './app/app.module';
import { environment } from './environments/environment';
import * as moment from 'moment';
import 'moment-timezone'; // pour pouvoir utiliser moment.tz merci à https://github.com/moment/moment-timezone/issues/385#issuecomment-392323276

if (environment.production) {
  enableProdMode();
}

platformBrowserDynamic().bootstrapModule(AppModule)
  .then(() => {
    moment.locale('fr');
    moment.tz.setDefault('UTC'); // Définition de la timezone par défaut à "UTC" pour être sûr de traiter toutes les dates comme UTC
  })
  .catch(err => console.error(err));
