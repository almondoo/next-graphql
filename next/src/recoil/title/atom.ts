import { atom } from 'recoil';

export const pageTitle = atom<string>({
  key: 'pageTitle',
  default: '',
});
