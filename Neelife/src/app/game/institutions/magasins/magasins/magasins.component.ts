import { AfterViewInit, Component, OnInit } from '@angular/core';
import { IMagasin } from 'src/app/game/shared/interfaces/magasin';
import { MagasinService } from 'src/app/shared/magasin.service';

declare const navbarShow:any;
declare const animation:any;


@Component({
  selector: 'app-magasins',
  templateUrl: './magasins.component.html',
  styleUrls: ['../../../game-component.scss', './magasins.component.scss']
})
export class MagasinsComponent implements OnInit, AfterViewInit {

  public lesMagasins : IMagasin[] = [];
  public errMsg!: string;


  constructor(private magasinService : MagasinService) { }

  ngOnInit(): void {
    this.magasinService.getMagasin().subscribe({
      next: magasins => this.lesMagasins = magasins,
      error: err => this.errMsg = err
    })
  }


  ngAfterViewInit(): void {
    navbarShow();
    animation();

  }

}
