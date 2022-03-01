import { useEffect } from 'react';
import { NextPage } from 'next';
import Template from 'components/templates/Task/index';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';
import type { Task } from 'models/task';

const tasks: Task[] = [
  { id: 1, title: 'Snow', text: 'Jon' },
  { id: 2, title: 'Lannister', text: 'Cersei' },
  { id: 3, title: 'Lannister', text: 'Jaime' },
  { id: 4, title: 'Stark', text: 'Arya' },
  { id: 5, title: 'Targaryen', text: 'Daenerys' },
  { id: 6, title: 'Melisandre', text: 'dafdsaldfjas' },
  { id: 7, title: 'Clifford', text: 'Ferrara' },
  { id: 8, title: 'Frances', text: 'Rossini' },
  { id: 9, title: 'Roxie', text: 'Harvey' },
];

const TaskPage: NextPage = () => {
  const setTitle = useSetRecoilState<string>(pageTitle);
  useEffect(() => {
    setTitle('Task');
  });

  return <Template tasks={tasks} />;
};

export default TaskPage;
