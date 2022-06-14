import { AfterViewInit, Component, OnInit } from '@angular/core';

declare const navbarShow:any;
declare const animation:any;


@Component({
  selector: 'app-institutions',
  templateUrl: './institutions.component.html',
  styleUrls: ['../../game-component.scss', './institutions.component.scss']
})
export class InstitutionsComponent implements OnInit, AfterViewInit {

  constructor() { }

  ngOnInit(): void {
  }

  ngAfterViewInit(): void {
    navbarShow();
    animation();

  }
}
