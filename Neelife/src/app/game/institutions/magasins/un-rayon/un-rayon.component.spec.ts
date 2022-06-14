import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UnRayonComponent } from './un-rayon.component';

describe('UnRayonComponent', () => {
  let component: UnRayonComponent;
  let fixture: ComponentFixture<UnRayonComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ UnRayonComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(UnRayonComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
