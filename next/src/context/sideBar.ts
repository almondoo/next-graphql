import { createContext, useState, useCallback } from 'react';

type TSideBarIsOpenContext = {
  isOpen: boolean;
  setState: (isOpen: boolean) => void;
};

const SideBarIsOpenDefaultContext: TSideBarIsOpenContext = {
  isOpen: false,
  setState: () => {},
};

export const SideBarIsOpenContext = createContext<TSideBarIsOpenContext>(SideBarIsOpenDefaultContext);

export const useSideBarIsOpen = (): TSideBarIsOpenContext => {
  const [isSideBarOpen, setIsSideBarOpen] = useState<boolean>(false);

  const setState = useCallback((isOpen: boolean): void => {
    setIsSideBarOpen(isOpen);
  }, []);

  return {
    isOpen: isSideBarOpen,
    setState,
  };
};
