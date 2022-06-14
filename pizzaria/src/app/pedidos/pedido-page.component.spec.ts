import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PedidoPageComponent } from './pedido-page.component';

describe('HomePageComponent', () => {
  let component: PedidoPageComponent;
  let fixture: ComponentFixture<PedidoPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PedidoPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PedidoPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
