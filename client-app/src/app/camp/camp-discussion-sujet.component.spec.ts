import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CampDiscussionSujetComponent } from './camp-discussion-sujet.component';

describe('CampDiscussionSujetComponent', () => {
  let component: CampDiscussionSujetComponent;
  let fixture: ComponentFixture<CampDiscussionSujetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CampDiscussionSujetComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CampDiscussionSujetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
