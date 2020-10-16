import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CampOngletRemarquesComponent } from './camp-onglet-remarques.component';

describe('CampOngletRemarquesComponent', () => {
  let component: CampOngletRemarquesComponent;
  let fixture: ComponentFixture<CampOngletRemarquesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CampOngletRemarquesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CampOngletRemarquesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
