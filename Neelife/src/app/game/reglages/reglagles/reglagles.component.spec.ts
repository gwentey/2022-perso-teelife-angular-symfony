import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ReglaglesComponent } from './reglagles.component';

describe('ReglaglesComponent', () => {
  let component: ReglaglesComponent;
  let fixture: ComponentFixture<ReglaglesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ReglaglesComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ReglaglesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
