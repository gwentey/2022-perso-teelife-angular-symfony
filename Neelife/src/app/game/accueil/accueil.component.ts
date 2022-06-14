import { AfterViewInit, Component, OnInit } from '@angular/core';

declare const navbarShow:any;

@Component({
  selector: 'app-accueil',
  templateUrl: './accueil.component.html',
  styleUrls: ['./accueil.component.scss', '../game-component.scss']
})
export class AccueilComponent implements OnInit, AfterViewInit {

  constructor() { }

  ngOnInit(): void {
  }

  ngAfterViewInit(): void {
    navbarShow();
  }

}
