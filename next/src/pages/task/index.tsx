import { useEffect } from 'react';
import type { GetServerSideProps, NextPage } from 'next';
import type { Task } from 'models/task';
import type { Paginate } from 'models/utils';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';
import { FETCH_TASKS_QUERY, TaskData } from 'graphql/taskList/query/fetchTasks';
import client from 'graphql/apollo-server';
import Template from 'components/templates/Task/index';

type Props = {
  tasks: Task[];
  paginate: Paginate;
};

const TaskPage: NextPage<Props> = ({ tasks, paginate }) => {
  const setTitle = useSetRecoilState<string>(pageTitle);

  useEffect(() => {
    setTitle('Task');
  }, []);

  return <Template tasks={tasks} paginate={paginate} />;
};

export const getServerSideProps: GetServerSideProps = async (ctx) => {
  const page = Number(ctx.query.page) ?? 1;
  const { data } = await client.query<TaskData>({
    query: FETCH_TASKS_QUERY,
    variables: {
      page: page,
    },
  });

  return {
    props: {
      tasks: data.tasks.data,
      paginate: data.tasks.paginatorInfo,
    },
  };
};

export default TaskPage;
