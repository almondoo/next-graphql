import { useEffect } from 'react';
import type { NextPage } from 'next';
import Template from '../components/templates/Home/index';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from '../recoil/title/atom';

const HomePage: NextPage = () => {
  const setTitle = useSetRecoilState<string>(pageTitle);
  useEffect(() => {
    setTitle('Home');
  });
  return <Template />;
};

export default HomePage;
