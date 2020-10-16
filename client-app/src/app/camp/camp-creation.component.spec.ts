import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CampCreationPageComponent } from './camp-creation.page.component';

describe('CampCreationComponent', () => {
  let component: CampCreationPageComponent;
  let fixture: ComponentFixture<CampCreationPageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CampCreationPageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CampCreationPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
