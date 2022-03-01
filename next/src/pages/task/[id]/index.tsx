import { useEffect } from 'react';
import { NextPage } from 'next';
import Template from 'components/templates/TaskDetail/index';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';

const TaskDetail: NextPage = () => {
  const setTitle = useSetRecoilState<string>(pageTitle);
  useEffect(() => {
    setTitle('TaskDetail');
  });
  return <Template />;
};

export default TaskDetail;
