import { User } from 'models/user';

export type Task = {
  id: number;
  title: string;
  text: string;
  user?: User;
};
