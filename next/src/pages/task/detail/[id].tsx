import { useEffect } from 'react';
import { GetServerSideProps, NextPage } from 'next';
import Template from 'components/templates/TaskDetail/index';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';
import client from 'graphql/apollo-server';
import { FETCH_TASK_DETAIL_DATA, TaskDetailData } from 'graphql/taskDetail/query/fetchData';
import type { Task } from 'models/task';
import type { TaskStatus } from 'models/task_status';

type Props = {
  task?: Task;
  task_statuses: TaskStatus[];
};

const TaskDetailPage: NextPage<Props> = ({ task, task_statuses }) => {
  const setTitle = useSetRecoilState<string>(pageTitle);

  useEffect(() => {
    setTitle('TaskDetail');
  });

  return <Template task={task} task_statuses={task_statuses} />;
};

export const getServerSideProps: GetServerSideProps = async (ctx) => {
  const id = Number(ctx.query.id);

  const { data } = await client.query<TaskDetailData>({
    query: FETCH_TASK_DETAIL_DATA,
    variables: {
      id,
    },
  });

  if (!data.task) {
    return {
      notFound: true,
    };
  }

  return {
    props: {
      task: data.task,
      task_statuses: data.task_statuses,
    },
  };
};

export default TaskDetailPage;
