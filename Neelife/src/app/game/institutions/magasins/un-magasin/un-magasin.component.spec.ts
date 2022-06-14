import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UnMagasinComponent } from './un-magasin.component';

describe('UnMagasinComponent', () => {
  let component: UnMagasinComponent;
  let fixture: ComponentFixture<UnMagasinComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ UnMagasinComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(UnMagasinComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
