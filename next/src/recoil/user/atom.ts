import { atom } from 'recoil';
import type { User } from '../../models/user';

export const userState = atom<User>({
  key: 'userState',
  default: {
    name: '',
    email: '',
  },
});
