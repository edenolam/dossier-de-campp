import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CampDiscussionSujetDetailComponent } from './camp-discussion-sujet-detail.component';

describe('CampDiscussionSujetDetailComponent', () => {
  let component: CampDiscussionSujetDetailComponent;
  let fixture: ComponentFixture<CampDiscussionSujetDetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CampDiscussionSujetDetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CampDiscussionSujetDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
