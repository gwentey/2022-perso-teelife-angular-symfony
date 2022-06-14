import { AfterViewInit, Component, OnInit } from '@angular/core';

declare const navbarShow:any;

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit, AfterViewInit {

  constructor() { }

  ngOnInit(): void {
  }


  ngAfterViewInit(): void {
    navbarShow();
  }
}
