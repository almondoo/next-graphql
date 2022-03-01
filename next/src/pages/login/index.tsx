import { useEffect } from 'react';
import { NextPage } from 'next';
import Template from 'components/templates/Login/index';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';

const Login: NextPage = () => {
  const setTitle = useSetRecoilState<string>(pageTitle);
  useEffect(() => {
    setTitle('Login');
  });

  return <Template />;
};

export default Login;
