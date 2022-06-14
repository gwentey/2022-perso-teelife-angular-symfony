import { AfterViewInit, Component, OnInit } from '@angular/core';

declare const navbarShow:any;

@Component({
  selector: 'app-reglagles',
  templateUrl: './reglagles.component.html',
  styleUrls: ['./reglagles.component.scss', '../../game-component.scss']
})
export class ReglaglesComponent implements OnInit, AfterViewInit {

  constructor() { }

  ngOnInit(): void {
  }

  ngAfterViewInit(): void {
    navbarShow();
  }


}
