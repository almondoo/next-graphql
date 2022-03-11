import { atom } from 'recoil';

export const taskPage = atom<number>({
  key: 'taskPage',
  default: 1,
});

export const userPage = atom<number>({
  key: 'userPage',
  default: 1,
});

export const communityPage = atom<number>({
  key: 'communityPage',
  default: 1,
});
