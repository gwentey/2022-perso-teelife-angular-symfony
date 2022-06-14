import { AfterViewInit, Component, ElementRef, HostListener, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';

declare const mapVille:any;
declare const navbarShow:any;

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['../../game-component.scss', './map.component.scss']
})
export class MapComponent implements OnInit, AfterViewInit {

  @ViewChild('mapContainer', {static: false}) container!: ElementRef<HTMLElement>;

  constructor(private router: Router){
  }

  ngOnInit(): void {

  }


  ngAfterViewInit(): void {
    mapVille();
    navbarShow();

    var stanley = this.container.nativeElement.querySelectorAll('[stanley]');
    var hippolyte = this.container.nativeElement.querySelectorAll('[hippolyte]');
    var mia = this.container.nativeElement.querySelectorAll('[mia]');
    var athena = this.container.nativeElement.querySelectorAll('[athena]');

    stanley.forEach(val => {
      var converted = <HTMLElement>val;
      converted.addEventListener('click', () => {
        this.router.navigateByUrl('/game/institutions/institutions/stanley');
      });
    });
    hippolyte.forEach(val => {
      var converted = <HTMLElement>val;
      converted.addEventListener('click', () => {
        this.router.navigateByUrl('/game/institutions/institutions/hippolyte');
      });
    });
    mia.forEach(val => {
      var converted = <HTMLElement>val;
      converted.addEventListener('click', () => {
        this.router.navigateByUrl('/game/institutions/institutions/mia');
      });
    });
    athena.forEach(val => {
      var converted = <HTMLElement>val;
      converted.addEventListener('click', () => {
        this.router.navigateByUrl('/game/institutions/institutions/athena');
      });
    });
  }

}



