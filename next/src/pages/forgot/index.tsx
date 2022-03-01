import { useEffect } from 'react';
import { NextPage } from 'next';
import Template from 'components/templates/Forgot/index';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';

const Forgot: NextPage = () => {
  const setTitle = useSetRecoilState<string>(pageTitle);
  useEffect(() => {
    setTitle('Forgot');
  });

  return <Template />;
};

export default Forgot;
