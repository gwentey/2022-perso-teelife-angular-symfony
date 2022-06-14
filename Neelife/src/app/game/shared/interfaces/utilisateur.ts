import { IPersonnage } from "./personnage";

export interface IUtilisateur {

  id: number;
  pseudo: string;
  email: string;
  password: string;
  personnages: IPersonnage[];

}
