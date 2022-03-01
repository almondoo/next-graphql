import { useEffect } from 'react';
import { NextPage } from 'next';
import Template from 'components/templates/Task/index';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';

const Task: NextPage = () => {
  const setTitle = useSetRecoilState<string>(pageTitle);
  useEffect(() => {
    setTitle('Task');
  });
  return <Template />;
};

export default Task;
