import { IProduit } from "./produit";

export interface IProduitRayon {

  id: Number;
  id_produit: IProduit;
  quantite: Number;
  prix: Number;

}
