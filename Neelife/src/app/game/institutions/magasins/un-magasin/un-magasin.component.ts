import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { IMagasin } from 'src/app/game/shared/interfaces/magasin';
import { IRayon } from 'src/app/game/shared/interfaces/rayon';
import { MagasinService } from 'src/app/shared/magasin.service';
import { RayonService } from 'src/app/shared/rayon.service';

declare const navbarShow: any;
declare const animation:any;


@Component({
  selector: 'app-un-magasin',
  templateUrl: './un-magasin.component.html',
  styleUrls: ['../../../game-component.scss', './un-magasin.component.scss']
})
export class UnMagasinComponent implements OnInit {

  public magasin!: IMagasin;
  public id!: Number;
  public lesRayons: IRayon[] = [];

  constructor(private magasinService: MagasinService, private rayonService: RayonService, private route: ActivatedRoute) { }

  ngOnInit(): void {
    this.id = Number(this.route.snapshot.paramMap.get('id'));

    this.magasinService.getOneMagasin(this.id).subscribe({
      next: magasin => {
        this.magasin = magasin;
        this.rayonService.getRayonByMagasin(this.magasin.id).subscribe({
          next: rayon => this.lesRayons = rayon
        })

      }
    })
  }

  ngAfterViewInit(): void {
    navbarShow();
    animation();


  }

}
