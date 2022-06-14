import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BebibaComponent } from './bebiba.component';

describe('BebibaComponent', () => {
  let component: BebibaComponent;
  let fixture: ComponentFixture<BebibaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BebibaComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(BebibaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
