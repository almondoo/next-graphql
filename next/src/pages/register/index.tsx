import { useEffect } from 'react';
import { NextPage } from 'next';
import Template from 'components/templates/Register/index';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';

const Register: NextPage = () => {
  const setTitle = useSetRecoilState<string>(pageTitle);
  useEffect(() => {
    setTitle('Register');
  });
  return <Template />;
};

export default Register;
